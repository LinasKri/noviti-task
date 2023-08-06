<template>
  <div class="generator-bg h-100">
    <div class="container pt-5">
      <div class="row d-flex justify-content-between align-items-center">
        <div class="col-lg-6 col-md-12">
          <h1 class="my-4">Loan Schedule Generator</h1>
          <form @submit.prevent="generateLoanSchedule" class="mb-4">
            <div class="mb-3 d-flex align-items-center">
              <label for="amount" class="form-label">Loan Amount (EUR):</label>
              <input
                type="range"
                id="amount"
                v-model="amount"
                min="5000"
                max="50000"
                step="1000"
                required
                class="form-control-range mx-2"
              />
              <input
                type="number"
                v-model="amount"
                min="5000"
                max="50000"
                required
                class="form-control w-auto"
              />
            </div>
            <div class="mb-3 d-flex align-items-center">
              <label for="term" class="form-label">Term (month): </label>
              <input
                type="range"
                id="term"
                v-model="term"
                min="6"
                max="24"
                step="1"
                required
                class="form-control-range mx-2"
              />
              <input
                type="number"
                v-model="term"
                min="6"
                max="24"
                required
                class="form-control w-auto"
              />
            </div>

            <div>
              <button type="submit" class="btn btn-primary">
                Generate Loan Schedule
              </button>
            </div>
          </form>
        </div>

        <div class="col-lg-6 col-md-12">
          <infoText />
        </div>
      </div>

      <transition name="slide" mode="out-in">
        <div v-if="schedule.length" :key="scheduleKey" class="table-responsive">
          <table class="table table-striped">
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
      </transition>
    </div>
  </div>
</template>

<script>
import { ref, computed } from 'vue';
import axios from 'axios';
import InfoText from '../components/InfoText.vue';

export default {
  components: {
    InfoText,
  },
  setup() {
    const amount = ref(5000);
    const interestRate = ref(12.7);
    const term = ref(6);
    const schedule = ref([]);
    const scheduleKey = ref(0);

    const generateLoanSchedule = () => {
      const rate = interestRate.value / 100 / 12;
      const payment =
        (amount.value * rate * Math.pow(1 + rate, term.value)) /
        (Math.pow(1 + rate, term.value) - 1);
      let remainingAmount = amount.value;

      schedule.value = Array.from({ length: term.value }, (_, i) => {
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

      axios
        .post('/api/noviti', schedule.value)
        .then((response) => {
          console.log(response.data.message);
          console.log(response.data.id);
        })
        .catch((error) => {
          console.error(error);
        });

      scheduleKey.value++;
    };

    const calculateTotal = (property) => {
      return schedule.value.reduce(
        (acc, payment) => acc + payment[property],
        0
      );
    };

    const formatCurrency = (value) => {
      return value.toFixed(2);
    };

    const totalPrincipal = computed(() => calculateTotal('principal'));
    const totalInterest = computed(() => calculateTotal('interest'));
    const totalPayment = computed(() => calculateTotal('total'));

    return {
      amount,
      term,
      schedule,
      scheduleKey,
      generateLoanSchedule,
      totalPrincipal,
      totalInterest,
      totalPayment,
      formatCurrency,
    };
  },
};
</script>

<style>
.slide-enter-from,
.slide-leave-to {
  opacity: 0;
  transform: translateX(-100px);
}

.slide-enter-active {
  transition: all 1s ease;
}
.slide-leave-active {
  transition: all 0.5s ease;
}
</style>
