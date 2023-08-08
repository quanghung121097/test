<template>
    <div>
        <h2 class="text-center">Danh sách vé máy bay</h2>
        <div class="row">
            <div class="col-md-6">
                <form>
                    <div class="form-group">
                        <label>Điểm xuất phát</label>
                        <input type="text" class="form-control" v-model="params.start_point">
                    </div>
                    <div class="form-group">
                        <label>Điểm đến</label>
                        <input type="text" class="form-control" v-model="params.end_point">
                    </div>
                    <div class="form-group">
                        <label>Ngày bay</label>
                        <input type="datetime-local" class="form-control" v-model="params.start_time">
                    </div>
                    <div class="form-group">
                        <label>Ngày bay</label>
                        <select class="form-control" v-model="params.type">
                            <option value="1">loại 1</option>
                        </select>
                    </div>
                    <button type="button" class="mt-2 btn btn-primary" @click="searchTicket()">Tìm kiếm</button>
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
                    <th>Tổng số tiền đã bao gồm các loại phí và thuế liên quan</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="ticket in tickets" :key="ticket.id">
                    <td>{{ ticket.airline_company_id }}</td>
                    <td>{{ ticket.type }}</td>
                    <td>{{ ticket.start_time }}</td>
                    <td>{{ ticket.flight_number }}</td>
                    <td>{{ ticket.price }}</td>
                    <td>{{ ticket.id }}</td>
                    <td>
                        <div class="btn-group" role="group">
                            <router-link :to="{name: 'detail', params: { id: ticket.id }}" class="btn btn-success">Chi tiết chuyến bay</router-link>
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
                params: {
                    start_point: '',
                    end_point: '',
                    start_time: '',
                    type: '',
                }
            }
        },
        created() {
        },
        methods: {
            searchTicket() {
                console.log();
                this.axios
                    .get(`http://localhost/api/ticket/search`, { params: this.params })
                    .then(response => {
                        console.log(response);
                        this.tickets = response.data.data
                    }).catch(err => {
                        console.log(err);
                    });
            },
        }
    }
</script>