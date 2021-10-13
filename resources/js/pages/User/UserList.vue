<template>
    <div>
        <user-modal :item="item" v-on:onSaved="refreshData" ref="userModal"></user-modal>
        <div class="btn-group float-right">
            <button @click="fetchList" class="btn btn-success float-right">Yenile</button>
            <button @click="createData" class="btn btn-primary float-right">Yeni Kullanıcı</button>
        </div>
        <h1>Kullanıcılar</h1>
        <div v-if="errorMessage" class="alert alert-danger">
            {{ errorMessage }}
        </div>
        <table class="table table-hover" v-if="list && list.length">
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Mail</th>
                <th>İşlem</th>
            </tr>
            <tr v-for="item in list">
                <td>{{ item.id }}</td>
                <td>{{ item.name }}</td>
                <td>{{ item.email }}</td>
                <td>
                    <button @click="editData(item._id)" class="btn btn-primary">Düzenle</button>
                    <button @click="deleteData(item._id)" class="btn btn-danger">Sil</button>
                </td>
            </tr>
        </table>
        <p v-else>Kayıt Bulunamadı</p>
        <pagination :meta="meta" v-on:pageChange="fetchList"></pagination>
    </div>
</template>

<script>
import Pagination from "../../components/Pagination";
import UserModal from "./UserModal";

export default {
    components: {Pagination, UserModal},
    data() {
        return {
            id: null,
            item: {},
            list: null,
            errorMessage: null,
            meta: {}
        }
    },
    created() {
        this.fetchList();
    },
    methods: {
        fetchList(page = 1) {
            this.list = null;
            this.list = axios.get('/users', {params: {page}})
                .then(response => {
                    this.list = response.data.data;
                    this.meta = response.data.meta;
                })
                .catch(error => {
                    if (error.response != null)
                        this.errorMessage = error.response.data.message;
                    else
                        this.errorMessage = error.message;
                })
        },
        createData() {
            this.item = {};
            this.$refs.userModal.errorMessage = '';
            $("#userModal").modal("show");
        },
        refreshData(item) {
            this.fetchList();
        }, editData(id) {
            this.id = id;
            axios.get('/users/' + this.id)
                .then(response => {
                    this.$refs.userModal.errorMessage = '';
                    $("#userModal").modal("show");
                    this.item = response.data;
                })
                .catch(error => {
                    if (error.response != null)
                        this.errorMessage = error.response.data.message;
                    else
                        this.errorMessage = error.message;
                })
        },
        deleteData(id) {
            new swal({
                title: "Emin misiniz",
                text: "Silmek istediğinize emin misiniz?",
                type: "warning",
                showCancelButton: "true",
                cancelButtonText: "İptal",
                confirmButtonText: "Sil"
            }).then(result => {
                if (result.value) {
                    axios.delete("/users/" + id)
                        .then(response => {
                            this.fetchList();
                            toastr.success("Kayıt silindi", "Kullanıcı");
                        })
                }
            })
                .catch(error => {
                    if (error.response != null)
                        this.errorMessage = error.response.data.message;
                    else
                        this.errorMessage = error.message;
                });
        }
    }
}
</script>
