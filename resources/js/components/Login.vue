<template>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Login</div>

            <div class="card-body">
                <form @submit.prevent="login()">

                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">
                            E-Mail Address</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control"
                                   v-model="email" required autocomplete="email" autofocus>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                        <div class="col-md-6">
                            <input id="password" type="password"
                                   class="form-control" v-model="password" required
                                   autocomplete="current-password">
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                Login
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: 'Login',
    data() {
        return {
            email: '',
            password: '',
        }
    },
    mounted() {
    },
    methods: {
        login() {
            let data = {
                email: this.email,
                password: this.password,
            }
            let url = '/login'
            axios.post(url, data)
                .then((response) => {
                    console.log(response.data)
                })
                .catch()
                .finally(() => {
                })
        }
    }
}
</script>
