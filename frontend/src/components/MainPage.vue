<template>
    <div>
        <div>not authorized</div>
        <button @click="switchToLogin">login</button>
        <button @click="switchToRegister">register</button>
    </div>
</template>

<script>
    import {URLS} from '../base/enums'

    export default {
        methods: {
            switchToLogin () {
                window.location.href = URLS.LOGIN_URL;
            },
            switchToRegister () {
                window.location.href = URLS.REGISTER_URL;
            }
        }
    }
</script>

<style scoped>

</style>