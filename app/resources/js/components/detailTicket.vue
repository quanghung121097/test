<template>
    <div>
        <h2 class="text-center">Chi tiết vé</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Hãng máy bay</th>
                    <th>Loại vé</th>
                    <th>Điểm xuất phát</th>
                    <th>Điểm điến</th>
                    <th>Thời gian khởi hành</th>
                    <th>Số chuyến bay</th>
                    <th>Giá vé</th>
                    <th>Thuế</th>
                    <th>Phí cân</th>
                    <th>Tổng số tiền</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ ticket.airline_company.name }}</td>
                    <td>{{ ticket.type.name }}</td>
                    <td>{{ ticket.start_location_name }}</td>
                    <td>{{ ticket.end_location_name }}</td>
                    <td>{{ ticket.start_time }}</td>
                    <td>{{ ticket.flight_number }}</td>
                    <td>{{ ticket.price }}</td>
                    <td>{{ ticket.tax }} %</td>
                    <td>{{ ticket.fee }}</td>
                    <td>{{ totalPrice(ticket) }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    data() {
        return {
            ticket: [],
        };
    },
    computed: {
        isLoggedIn: function () {
            return this.$store.getters.isAuthenticated;
        },
    },
    created() {
        this.axios
            .get(`/api/ticket/detail/${this.$route.params.id}`)
            .then((res) => {
                this.ticket = res.data.data;
            });
    },
    methods: {
        totalPrice(ticket) {
            if (this.$store.getters.isAuthenticated) {
                let total = ticket.price + ticket.fee;
                total = total + total * ticket.tax;
                return total;
            } else {
                return "Đăng nhập để xem";
            }
        },
    },
};
</script>
