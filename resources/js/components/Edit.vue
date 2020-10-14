<template>
    <div class="modal fade" id="modal_edit" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Data</h5>
                    <button type="button" class="close" @click.prevent="resetAct" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form @submit.prevent="updateAct">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="skill_id">Skill</label>
                            <select v-model="form.skill_id" name="skill_id" class="form-control" :class="{ 'is-invalid': form.errors.has('skill_id') }">
                                    <option value="" disabled selected>Pilih Satu</option>
                                    <template v-for="(skill, index) in skills">
                                        <option :key="index" :value="skill.id">{{skill.name}}</option>
                                    </template>
                            </select>
                            <has-error :form="form" field="skill_id"></has-error>
                        </div>
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input v-model="form.title" type="text" name="title"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('title') }">
                            <has-error :form="form" field="title"></has-error>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <input v-model="form.description" type="text" name="description"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('description') }">
                            <has-error :form="form" field="description"></has-error>
                        </div>
                        <div class="form-group">
                            <label for="startdate">Start Date</label>
                            <input v-model="form.startdate" type="date" name="startdate"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('startdate') }">
                            <has-error :form="form" field="startdate"></has-error>
                        </div>
                        <div class="form-group">
                            <label for="enddate">End Date</label>
                            <input v-model="form.enddate" type="date" name="enddate"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('enddate') }">
                            <has-error :form="form" field="enddate"></has-error>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button @click.prevent="resetAct" type="button" class="btn btn-secondary">Reset</button>
                        <button :disabled="form.busy" type="submit" class="btn btn-primary">Update</button>
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
                skills: [],
                form: new Form({
                    id: '',
                    skill_id: '',
                    title: '',
                    description: '',
                    startdate: '',
                    enddate: '',
                    _method: 'PATCH'
                })
            }
        },

        mounted() {
            this.form.id = this.row.id
            this.form.skill_id = this.row.skill_id
            this.form.title = this.row.title
            this.form.description = this.row.description
            this.form.startdate = this.row.startdate
            this.form.enddate = this.row.enddate
        },

        created() {
            this.getSkills()
        },

        methods: {
            getSkills() {
                axios.get('api/v1/skills')
                    .then( res => {
                        this.skills = res.data
                    })
                    .catch(err => console.log(err))
            },

            updateAct() {
                this.form.post(`api/v1/activity/${this.form.id}`)
                    .then(res => {
                        this.getData()
                        this.resetAct()
                        Toast.fire({
                            icon: 'success',
                            title: 'Update success'
                        })
                    })
                    .catch(err => console.log(err))
            },

            resetAct() {
                this.form.clear()
                this.form.reset()
                this.hideEditModal()
                $('#modal_edit').modal('hide')
            }
        }
    }
</script>
