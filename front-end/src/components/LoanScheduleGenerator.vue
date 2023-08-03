<template>
  <div class="container">
    <h1 class="my-4">Loan Schedule Generation</h1>

    <form @submit.prevent="generateLoanSchedule" class="mb-4">
      <div class="mb-3">
        <label for="amount" class="form-label">Loan Amount (EUR):</label>
        <input
          type="range"
          id="amount"
          v-model="amount"
          min="5000"
          max="50000"
          step="1000"
          required
          class="form-control-range"
        />
        <span class="form-text">{{ amount }}</span>
      </div>
      <div class="mb-3">
        <label for="term" class="form-label">Term (month): </label>
        <input
          type="range"
          id="term"
          v-model="term"
          min="6"
          max="24"
          step="1"
          required
          class="form-control-range"
        />
        <span class="form-text">{{ term }}</span>
      </div>

      <div>
        <button type="submit" class="btn btn-primary">
          Generate Loan Schedule
        </button>
      </div>
    </form>

    <table v-if="schedule.length" class="table table-striped">
      <thead>
        <tr>
          <th>No.</th>
          <th>Remaining Credit Amount</th>
          <th>Principal Part</th>
          <th>Interest</th>
          <th>Total Payment</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(payment, index) in schedule" :key="index">
          <td>{{ index + 1 }}</td>
          <td>{{ formatCurrency(payment.remainingAmount) }}</td>
          <td>{{ formatCurrency(payment.principal) }}</td>
          <td>{{ formatCurrency(payment.interest) }}</td>
          <td>{{ formatCurrency(payment.total) }}</td>
        </tr>
        <tr class="table-info">
          <td>Total</td>
          <td></td>
          <td>{{ formatCurrency(totalPrincipal) }} EUR</td>
          <td>{{ formatCurrency(totalInterest) }} EUR</td>
          <td>{{ formatCurrency(totalPayment) }} EUR</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      amount: 5000,
      interestRate: 12.7,
      term: 6,
      schedule: [],
    };
  },

  methods: {
    calculateTotal(property) {
      return this.schedule.reduce((acc, payment) => acc + payment[property], 0);
    },
    generateLoanSchedule() {
      const rate = this.interestRate / 100 / 12;
      const payment =
        (this.amount * rate * Math.pow(1 + rate, this.term)) /
        (Math.pow(1 + rate, this.term) - 1);
      let remainingAmount = this.amount;

      this.schedule = Array.from({ length: this.term }, (_, i) => {
        const interest = remainingAmount * rate;
        const principal = payment - interest;
        remainingAmount -= principal;

        return {
          remainingAmount: remainingAmount,
          principal: principal,
          interest: interest,
          total: payment,
        };
      });
    },

    formatCurrency(value) {
      return value.toFixed(2);
    },

    async fetchMessage() {
      try {
        const response = await axios.get('/api/noviti');
        this.message = response.data.message;
      } catch (error) {
        console.error(error);
      }
    },
  },
  computed: {
    totalPrincipal() {
      return this.calculateTotal('principal');
    },
    totalInterest() {
      return this.calculateTotal('interest');
    },
    totalPayment() {
      return this.calculateTotal('total');
    },
  },
  mounted() {
    this.fetchMessage();
  },
};
</script>
