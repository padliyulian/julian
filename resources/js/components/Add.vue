<template>
    <div class="modal fade" id="modal_add" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Data</h5>
                    <button type="button" class="close" @click.prevent="resetActivity" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form @submit.prevent="addActivity">
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
                        <button @click.prevent="resetActivity" type="button" class="btn btn-secondary">Reset</button>
                        <button :disabled="form.busy" type="submit" class="btn btn-primary">Save</button>
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
                type:Function,
                default: () => ({}),
            },
            hideAddModal: {
                type: Function,
                default: () => ({}),
            },
        },

        components: {
            Form,
            HasError,
            AlertError
        },

        data() {
            return {
                skills: [],
                form: new Form({
                    skill_id: '',
                    title: '',
                    description: '',
                    startdate: '',
                    enddate: '',
                })
            }
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

            addActivity() {
                this.form.post('api/v1/activity')
                    .then(res => {
                        this.getData()
                        this.resetActivity()
                        Toast.fire({
                            icon: 'success',
                            title: 'Adding Success'
                        })
                    })
                    .catch(err => console.log(err))
            },

            resetActivity() {
                this.form.clear()
                this.form.reset()
                this.hideAddModal()
                $('#modal_add').modal('hide')
            }
        }
    }
</script>
