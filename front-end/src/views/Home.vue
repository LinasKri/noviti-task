<template>
  <div>
    <header class="masthead text-center text-white">
      <div class="masthead-content">
        <div class="container px-5">
          <h1 class="masthead-heading mb-0">
            Best Loan Schedule Generating App
          </h1>
          <h2 class="masthead-subheading mb-0">Will Rock Your Socks Off</h2>
          <router-link
            to="/loan-schedule-generator"
            class="btn btn-primary btn-xl rounded-pill mt-5 px-3"
            >Jump right in</router-link
          >
        </div>
      </div>
      <div
        v-for="i in 4"
        :key="i"
        :class="['bg-circle-' + i, 'bg-circle']"
      ></div>
    </header>
    <section id="scroll">
      <div class="container px-5">
        <div class="row gx-5 justify-content-center align-items-center">
          <div class="col-lg-8 order-lg-1">
            <div class="p-5">
              <h2 class="display-4 text-center mb-4">
                For those who seek best deals!
              </h2>
              <p class="text-">
                We offer the best platform to get most accurate calculations for
                loan paymenst. We hope that you'll have the best experience on
                our platform.
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>
