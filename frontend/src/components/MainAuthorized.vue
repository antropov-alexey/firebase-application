<template>
    <div>
        <div>hello, {{ userName }}</div>
        <button @click="documents">documents</button>
        <button @click="images">images</button>
        <button @click="logout">logout</button>
    </div>
</template>

<script>
    import {URLS} from '../base/enums'
    import axios from '../../node_modules/axios';

    export default {
        props  : {
            userName: String
        },
        methods: {
            logout () {
                axios.post(URLS.LOGOUT_URL);

                window.location.href = URLS.MAIN_PAGE;
            },
            documents () {
                window.location.href = URLS.DOCUMENTS_URL;
            },
            images () {
                window.location.href = URLS.IMAGES_URL;
            }
        }
    }
</script>

<style scoped>

</style>