<template>
  <div class="container">
    <h2 class="card-header">Tìm kiếm vé máy bay</h2>
    <div class="card card-default">
      <div class="card-body">
        <form>
          <div class="form-group">
            <label>Điểm xuất phát</label>
            <select class="form-control" v-model="params.start_location">
              <option
                v-for="location in locations"
                :key="location.id"
                :value="location.id"
              >
                {{ location.name }}
              </option>
            </select>
          </div>
          <div class="form-group">
            <label>Điểm đến</label>
            <select class="form-control" v-model="params.end_location">
              <option
                v-for="location in locations"
                :key="location.id"
                :value="location.id"
              >
                {{ location.name }}
              </option>
            </select>
          </div>
          <div class="form-group">
            <label>Ngày bay</label>
            <input
              type="date"
              class="form-control"
              v-model="params.start_time"
            />
          </div>
          <div class="form-group">
            <label>Loại vé</label>
            <select class="form-control" v-model="params.type_id">
              <option
                v-for="ticketType in ticketTypes"
                :key="ticketType.id"
                :value="ticketType.id"
              >
                {{ ticketType.name }}
              </option>
            </select>
          </div>
          <button
            type="button"
            class="mt-2 btn btn-primary"
            @click="searchTicket()"
          >
            Tìm kiếm
            <div
              v-show="loading"
              class="spinner-border spinner-border-sm ml-2 mr-2"
              role="status"
            ></div>
          </button>
          <div class="mt-2 text-danger">
            <span v-if="error != ''">{{ error }}</span>
          </div>
        </form>
      </div>
    </div>
    <table class="table" v-if="tickets.length > 0">
      <thead>
        <tr>
          <th>Hãng máy bay</th>
          <th>Loại vé</th>
          <th>Thời gian khởi hành</th>
          <th>Số chuyến bay</th>
          <th>Giá vé</th>
          <th>Tổng số tiền</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="ticket in tickets" :key="ticket.id">
          <td>{{ ticket.airline_company_name }}</td>
          <td>{{ ticket.type_name }}</td>
          <td>{{ ticket.start_time }}</td>
          <td>{{ ticket.flight_number }}</td>
          <td>{{ ticket.price }}</td>
          <td>{{ totalPrice(ticket)}}</td>
          <td>
            <div class="btn-group" role="group">
              <router-link
                :to="{ name: 'detail', params: { id: ticket.id } }"
                class="btn btn-success"
                >Chi tiết chuyến bay</router-link
              >
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>
 
<script>
export default {
  data() {
    return {
      tickets: [],
      locations: [],
      airlineCompanys: [],
      ticketTypes: [],
      params: {
        start_location: "",
        end_location: "",
        start_time: "",
        type: "",
      },
      error: "",
      loading: false,
    };
  },
  created() {
    this.getDataQuery();
  },
  methods: {
    getDataQuery() {
      this.axios
        .get(`/api/ticket`)
        .then((response) => {
          if (response.data.success == true) {
            let data = response.data.data;
            this.locations = data.locations;
            this.airlineCompanys = data.airlineCompanys;
            this.ticketTypes = data.ticketTypes;
          }
        })
        .catch((error) => {
          this.tickets = [];
          if (error.response) {
            this.error = error.response.data.message;
          } else if (error.request) {
            this.error = "network error";
          } else {
            this.error = error;
          }
          this.loading = false;
        })
        .finally(() => (this.loading = false));
    },
    searchTicket() {
      this.loading = true;
      this.axios
        .get(`/api/ticket/search`, { params: this.params })
        .then((response) => {
          let data = response.data;
          if (data.success == true) {
            this.tickets = data.data;
            this.error = "";
          } else {
            this.tickets = [];
            this.error = data.message;
          }
        })
        .catch((error) => {
          this.tickets = [];
          if (error.response) {
            this.error = error.response.data.message;
          } else if (error.request) {
            this.error = "network error";
          } else {
            this.error = error;
          }
        })
        .finally(() => (this.loading = false));
    },
    totalPrice(ticket) {
        return 'Đăng nhập để xem'
    }
  },
};
</script>