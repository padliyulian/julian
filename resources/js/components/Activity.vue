<template>
    <div class="container">
        <div class="row py-4">
                    <div class="col-lg-12">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-6"><h5 class="mb-0">Julian App</h5></div>
                                    <div class="col-6 text-right">Developer <a href="https://padliyulian.github.io" target="_blank" rel="noopener noreferrer">padliyulian@gmail.com</a></div>
                                </div>
                            </div>
                            <div class="card-body">

                                    <div class="row">
                                        <div class="form-group col-lg-3">
                                            <button @click="addMode=true" data-target="#modal_add" data-toggle="modal" class="btn btn-primary btn-block">Add</button>
                                        </div>
                                        <div class="form-group col-lg-2">
                                            <select @change="changeLength" v-model="length" class="custom-select">
                                                <option value="10">10</option>
                                                <option value="25">25</option>
                                                <option value="50">50</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-lg-7">
                                            <input @keyup="searchActivity" class="form-control" type="text" v-model="search" placeholder="Search ...">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <table class="table table-responsive-md table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th @click.prevent="sortBy('title')" style="cursor:pointer;" scope="col">
                                                            <i class="fas fa-sort"></i>
                                                            Title
                                                        </th>
                                                        <th @click.prevent="sortBy('description')" style="cursor:pointer;" scope="col">
                                                            <i class="fas fa-sort"></i>
                                                            Description
                                                        </th>
                                                        <th @click.prevent="sortBy('startdate')" style="cursor:pointer;" scope="col">
                                                            <i class="fas fa-sort"></i>
                                                            Start Date
                                                        </th>
                                                        <th @click.prevent="sortBy('enddate')" style="cursor:pointer;" scope="col">
                                                            <i class="fas fa-sort"></i>
                                                            End Date
                                                        </th>
                                                        <th scope="col">
                                                            Participants
                                                        </th>
                                                        <th scope="col" style="min-width:100px;">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr v-for="item in data.data" :key="item.id">
                                                        <td>{{item.title}}</td>
                                                        <td>{{item.description}}</td>
                                                        <td>{{$moment(item.startdate).format('D/MM/YYYY')}}</td>
                                                        <td>{{$moment(item.enddate).format('D/MM/YYYY')}}</td>
                                                        <td class="c-overflow">
                                                            <div class="c-height">
                                                                <div v-for="(el,i) in item.participants" :key="el.id">
                                                                    <div>{{el.name}}</div>
                                                                    <div>{{el.profile}}</div>
                                                                    <div>{{el.skill.name}},</div>
                                                                    <hr v-if="i != item.participants.length-1">
                                                                </div>
                                                            </div>    
                                                        </td>
                                                        <td>
                                                            <a @click.prevent="showEditModal(item)" href="#" title="Ubah" data-target="#modal_edit" data-toggle="modal">
                                                                <span class="text-warning">
                                                                    <i class="fa fa-edit" aria-hidden="true"></i>
                                                                </span>
                                                            </a>
                                                            <a @click.prevent="deleteRow(item.id)" href="#" title="Hapus">
                                                                <span class="text-danger">
                                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                                </span>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 d-flex flex-row justify-content-between">
                                            <div>
                                                <span class="text-secondary">
                                                    Showing {{data.from}} to {{data.to}} of {{ data.total }} Entries
                                                </span>
                                            </div>
                                            <div>
                                                <nav aria-label="Page navigation example">
                                                    <ul class="pagination">
                                                        <li class="page-item" :class="{disabled: data.current_page === 1}">
                                                            <a @click.prevent="firstPage" class="page-link" href="#" aria-label="First" :aria-disabled="data.current_page === 1">
                                                                <span aria-hidden="true">&laquo;</span>
                                                            </a>
                                                        </li>

                                                        <li class="page-item" :class="{disabled: data.prev_page_url === null}">
                                                            <a @click.prevent="prevPage" class="page-link" href="#" aria-label="Previous" :aria-disabled="data.prev_page_url === null">
                                                                <span aria-hidden="true">Prev</span>
                                                            </a>
                                                        </li>
                                                        <li class="page-item" :class="{disabled: data.next_page_url === null}">
                                                            <a @click.prevent="nextPage" class="page-link" href="#" aria-label="Next" :aria-disabled="data.next_page_url === null">
                                                                <span aria-hidden="true">Next</span>
                                                            </a>
                                                        </li>


                                                        <li class="page-item" :class="{disabled: data.current_page === data.last_page}">
                                                            <a @click.prevent="lastPage" class="page-link" href="#" aria-label="Last" :aria-disabled="data.current_page === data.last_page">
                                                                <span aria-hidden="true">&raquo;</span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </nav>
                                            </div>
                                        </div>
                                    </div>

                            </div>
                        </div>
                    </div>

            <add-modal v-if="addMode" :getData="getData" :hideAddModal="hideAddModal"/>
            <edit-modal v-if="editMode" :row="selectedRow" :getData="getData" :hideEditModal="hideEditModal"/>
        </div>
    </div>
</template>


<script>
    import { AddModal, EditModal } from '../components'
    export default {
        name: 'Activity',

        components: {
            AddModal,
            EditModal
        },

        data() {
            return {
                length: 10,
                column: 'id',
                dir: 'desc',
                search: '',
                data: {},

                addMode: false,
                editMode: false,
                detailMode: false,
                selectedRow: {},
            }
        },

        created() {
            this.getActivity(`api/v1/activity?page=1&length=${this.length}&column=${this.column}&dir=${this.dir}&search=${this.search}`)
        },

        mounted() {
        },

        methods: {
            getActivity(url) {
                axios.get(url)
                    .then(res => this.data = res.data)
                    .catch(err => console.log(err))
            },

            deleteRow(id) {
                swalWithBootstrapButtons.fire({
                    title: 'Sure delete it?',
                    text: "You can't revert it!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes!',
                    cancelButtonText: 'No!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                        axios.delete(`api/v1/activity/${id}`)
                            .then(res => {
                                this.getData()
                            })
                            .catch(err => console.log(err))

                        swalWithBootstrapButtons.fire(
                            'Deleted!',
                            'Data has deleted.',
                            'success'
                        )
                    } else if (
                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                        swalWithBootstrapButtons.fire(
                            'Reset',
                            'Cancel deleted',
                            'error'
                        )
                    }
                })
            },

            showEditModal(row) {
                this.editMode = true
                this.selectedRow = row
            },

            showDetailModal(row) {
                this.detailMode = true
                this.selectedRow = row
            },

            hideEditModal() {
                this.editMode = false,
                this.selectedRow = {}
            },

            hideDetailModal() {
                this.detailMode = false,
                this.selectedRow = {}
            },

            hideAddModal() {
                this.addMode = false
            },

            getData() {
                this.getActivity(`api/v1/activity?page=1&length=${this.length}&column=${this.column}&dir=${this.dir}&search=${this.search}`)
            },

            searchActivity() {
                this.getActivity(`api/v1/activity?page=1&length=${this.length}&column=${this.column}&dir=${this.dir}&search=${this.search}`)
            },

            changeLength() {
                this.getActivity(`api/v1/activity?page=1&length=${this.length}&column=${this.column}&dir=${this.dir}&search=${this.search}`)
            },

            firstPage() {
                this.getActivity(`api/v1/activity?page=1&length=${this.length}&column=${this.column}&dir=${this.dir}&search=${this.search}`)
            },

            lastPage() {
                this.getActivity(`api/v1/activity?page=${this.data.last_page}&length=${this.length}&column=${this.column}&dir=${this.dir}&search=${this.search}`)
            },

            prevPage() {
                this.getActivity(`${this.data.prev_page_url}&length=${this.length}&column=${this.column}&dir=${this.dir}&search=${this.search}`)
            },

            nextPage() {
                this.getActivity(`${this.data.next_page_url}&length=${this.length}&column=${this.column}&dir=${this.dir}&search=${this.search}`)
            },

            sortBy(key) {
                if (this.dir == 'desc') {
                    this.dir = 'asc'
                } else {
                    this.dir = 'desc'
                }

                this.getActivity(`${this.data.first_page_url}&length=${this.length}&column=${key}&dir=${this.dir}&search=${this.search}`)
            }
        }
    }
</script>


<style lang="scss" scoped>
    .c-overflow {
        overflow: auto;
    }

    .c-height {
        max-height: 100px;
    }
</style>
