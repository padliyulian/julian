<template>
    <div class="modal fade" id="modal_detail" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Data</h5>
                    <button type="button" class="close" @click.prevent="resetSingkong" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table-responsive">
                        <tbody>
                            <tr>
                                <td>No. Surat</td>
                                <td class="px-4">:</td>
                                <td>{{row.no_surat}}</td>
                            </tr>
                            <tr>
                                <td>Sopir</td>
                                <td class="px-4">:</td>
                                <td>{{row.sopir}}</td>
                            </tr>
                            <tr>
                                <td>Agen</td>
                                <td class="px-4">:</td>
                                <td>{{row.agen}}</td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td class="px-4">:</td>
                                <td>{{row.alamat}}</td>
                            </tr>
                            <tr>
                                <td>Jenis Kendaraan</td>
                                <td class="px-4">:</td>
                                <td>{{row.jenis_kendaraan}}</td>
                            </tr>
                            <tr>
                                <td>No. Kendaraan</td>
                                <td class="px-4">:</td>
                                <td>{{row.no_kendaraan}}</td>
                            </tr>
                            <tr>
                                <td>Tanggal & Jam</td>
                                <td class="px-4">:</td>
                                <td>{{$moment(row.created_at).format('D/MM/YYYY HH:mm')}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button @click.prevent="resetSingkong" type="button" class="btn btn-secondary">Batal</button>
                    <a @click="resetSingkong" :href="'/print/'+row.id" target="_blank" class="btn btn-primary">Cetak</a>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
    export default {
        props: {
            hideDetailModal: {
                type: Function,
                default: () => ({}),
            },
            row: {
                type: Object,
                default: () => ({}),
            }
        },

        components: {

        },

        data() {
            return {
            }
        },

        mounted() {
        },

        methods: {
            resetSingkong() {
                this.hideDetailModal()
                $('#modal_detail').modal('hide')
            }
        }
    }
</script>
