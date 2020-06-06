<template>
    <div class="register-page">
        <div class="form">
            <div class="register-form">
                <input type="email" placeholder="email" v-model="email" required/>

                <div class="error-block" v-if="emailErrors.length">
                    <span v-for="error in emailErrors">{{ error }}</span>
                </div>

                <input type="password" placeholder="password" v-model="password"/>

                <div class="error-block" v-if="passwordErrors.length">
                    <span v-for="error in passwordErrors">{{ error }}</span>
                </div>

                <button type="button" :disabled="isButtonDisabled" @click="registerAction">register</button>

                <p class="message">Already registered? <a :href="loginUrl">Sign In</a></p>
            </div>
        </div>
    </div>
</template>

<script>
    import {URLS} from '../../base/enums'
    import {LOGIN_ERROR_CODES} from '../../base/enums'
    import axios from '../../../node_modules/axios';

    export default {
        data () {
            return {
                email           : '',
                password        : '',
                emailErrors     : [],
                passwordErrors  : [],
                isButtonDisabled: false,
            }
        },
        computed: {
            loginUrl () {
                return URLS.LOGIN_URL;
            }
        },
        methods : {
            clearErrors () {
                this.emailErrors    = [];
                this.passwordErrors = [];
            },
            disableButton () {
                this.isButtonDisabled = true;
            },
            enableButton () {
                this.isButtonDisabled = false;
            },
            registerAction () {
                this.disableButton();
                this.clearErrors();

                if (!this.email.length) {
                    this.emailErrors.push('You should fill this field');
                    this.enableButton();
                    return;
                }

                if (!this.password.length) {
                    this.passwordErrors.push('You should fill this field');
                    this.enableButton();
                    return;
                }

                const formData = {
                    email   : this.email,
                    password: this.password,
                };

                axios
                    .post(URLS.REGISTER_URL, formData)
                    .then((data) => {
                            if (data.data.errorCode) {
                                if (data.data.errorCode === LOGIN_ERROR_CODES.EMAIL_NOT_FOUND) {
                                    this.emailErrors.push('Email not found.');
                                }
                                else if (data.data.errorCode === LOGIN_ERROR_CODES.INVALID_EMAIL) {
                                    this.emailErrors.push('Invalid email.');
                                }
                                else if (data.data.errorCode === LOGIN_ERROR_CODES.INVALID_PASSWORD) {
                                    this.passwordErrors.push('Invalid password.');
                                }
                                else if (data.data.errorCode === LOGIN_ERROR_CODES.USER_DISABLED) {
                                    this.emailErrors.push('User disabled by administrator.');
                                }
                            }
                            this.enableButton();
                        }
                    );
            }
        }
    }
</script>

<style lang="scss" scoped>
    .register-page {
        width: 360px;
        padding: 8% 0 0;
        margin: auto;
    }

    .form {
        position: relative;
        z-index: 1;
        background: #FFFFFF;
        max-width: 360px;
        margin: 0 auto 100px;
        padding: 45px;
        text-align: center;
        box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
    }

    .form input {
        font-family: "Roboto", sans-serif;
        outline: 0;
        background: #f2f2f2;
        width: 100%;
        border: 0;
        margin: 0 0 5px;
        padding: 15px;
        box-sizing: border-box;
        font-size: 14px;
    }

    .form button {
        font-family: "Roboto", sans-serif;
        text-transform: uppercase;
        outline: 0;
        background: #4CAF50;
        width: 100%;
        border: 0;
        padding: 15px;
        margin: 10px 0 0;
        color: #FFFFFF;
        font-size: 14px;
        -webkit-transition: all 0.3 ease;
        transition: all 0.3 ease;
        cursor: pointer;
    }

    .form button:hover, .form button:active, .form button:focus {
        background: #43A047;
    }

    .form button:disabled {
        background: #CCCCCC;
    }

    .form .message {
        margin: 15px 0 0;
        color: #b3b3b3;
        font-size: 14px;
    }

    .form .message a {
        color: #4CAF50;
        text-decoration: none;
    }

    .container {
        position: relative;
        z-index: 1;
        max-width: 300px;
        margin: 0 auto;
    }

    .container:before, .container:after {
        content: "";
        display: block;
        clear: both;
    }

    .container .info {
        margin: 50px auto;
        text-align: center;
    }

    .container .info h1 {
        margin: 0 0 15px;
        padding: 0;
        font-size: 36px;
        font-weight: 300;
        color: #1a1a1a;
    }

    .container .info span {
        color: #4d4d4d;
        font-size: 12px;
    }

    .container .info span a {
        color: #000000;
        text-decoration: none;
    }

    .container .info span .fa {
        color: #EF3B3A;
    }

    body {
        background: #76b852; /* fallback for old browsers */
        background: -webkit-linear-gradient(right, #76b852, #8DC26F);
        background: -moz-linear-gradient(right, #76b852, #8DC26F);
        background: -o-linear-gradient(right, #76b852, #8DC26F);
        background: linear-gradient(to left, #76b852, #8DC26F);
        font-family: "Roboto", sans-serif;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }

    .error-block {
        color: #EF3B3A;
        padding: 0;
        margin: 0 0 15px;
    }
</style>

