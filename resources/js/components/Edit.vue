<template>
    <div class="modal fade" id="modal_edit" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ubah Data</h5>
                    <button type="button" class="close" @click.prevent="resetSingkong" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form @submit.prevent="updateSingkong">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="no_surat">No. Surat</label>
                            <input v-model="form.no_surat" type="text" name="no_surat"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('no_surat') }" placeholder="Nomer Surat">
                            <has-error :form="form" field="no_surat"></has-error>
                        </div>
                        <div class="form-group">
                            <label for="sopir">Sopir</label>
                            <input v-model="form.sopir" type="text" name="sopir"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('sopir') }" placeholder="Nama sopir">
                            <has-error :form="form" field="sopir"></has-error>
                        </div>
                        <div class="form-group">
                            <label for="agen">Agen</label>
                            <input v-model="form.agen" type="text" name="agen"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('agen') }" placeholder="Nama agen">
                            <has-error :form="form" field="agen"></has-error>
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea rows="5" name="alamat" v-model="form.alamat" class="form-control" :class="{ 'is-invalid': form.errors.has('alamat') }" id="alamat" placeholder="Ketik disini ..."></textarea>
                            <has-error :form="form" field="alamat"></has-error>
                        </div>
                        <div class="form-group">
                            <label for="jenis_kendaraan">Jenis Kendaraan</label>
                            <select v-model="form.jenis_kendaraan" name="jenis_kendaraan" class="form-control" :class="{ 'is-invalid': form.errors.has('jenis_kendaraan') }">
                                    <option value="" disabled selected>Pilih Satu</option>
                                    <template v-for="(kendaraan, index) in kendaraans">
                                        <option :key="index" :value="kendaraan">{{kendaraan}}</option>
                                    </template>
                            </select>
                            <has-error :form="form" field="jenis_kendaraan"></has-error>
                        </div>
                        <div class="form-group">
                            <label for="no_kendaraan">No. Kendaraan</label>
                            <input v-model="form.no_kendaraan" type="text" name="no_kendaraan"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('no_kendaraan') }" placeholder="Nomer / plat kendaraan">
                            <has-error :form="form" field="no_kendaraan"></has-error>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button @click.prevent="resetSingkong" type="button" class="btn btn-secondary">Batal</button>
                        <button :disabled="form.busy" type="submit" class="btn btn-primary">Ubah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>


<script>
    import { Form, HasError, AlertError } from 'vform'
    export default {
        props: {
            getData: {
                type: Function,
                default: () => ({}),
            },
            hideEditModal: {
                type: Function,
                default: () => ({}),
            },
            row: {
                type: Object,
                default: () => ({}),
            }
        },

        components: {
            Form, HasError, AlertError
        },

        data() {
            return {
                kendaraans: ['Truk', 'Cold Diesel', 'Fuso', 'Pickup', 'Lainnya'],
                form: new Form({
                    id: '',
                    no_surat: '',
                    sopir: '',
                    agen: '',
                    alamat: '',
                    jenis_kendaraan: '',
                    no_kendaraan: '',
                    _method: 'PATCH'
                })
            }
        },

        mounted() {
            this.form.id = this.row.id,
            this.form.no_surat = this.row.no_surat,
            this.form.sopir = this.row.sopir,
            this.form.agen = this.row.agen,
            this.form.alamat = this.row.alamat,
            this.form.jenis_kendaraan = this.row.jenis_kendaraan,
            this.form.no_kendaraan = this.row.no_kendaraan
        },

        methods: {
            updateSingkong() {
                this.form.post(`api/v1/singkong/${this.form.id}`)
                    .then(res => {
                        this.getData()
                        this.resetSingkong()
                        Toast.fire({
                            icon: 'success',
                            title: 'Ubah data berhasil'
                        })
                    })
                    .catch(err => console.log(err))
            },

            resetSingkong() {
                this.form.clear()
                this.form.reset()
                this.hideEditModal()
                $('#modal_edit').modal('hide')
            }
        }
    }
</script>
