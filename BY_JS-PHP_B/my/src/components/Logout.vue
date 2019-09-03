<template>
    <div></div>
</template>

<script type="text/ecmascript-6">
    export default {
        name: "logout",
        props:['token'],
        mounted() {
            fetch('http://server9.com/BY_JS-PHP_A/api/v1/logout?token='+this.token,{
                method:'get',
                headers : new Headers({'content-type': 'application/json'}),
            }).then(res=> {
                res.json().then(data=> {
                    // console.log(data);

                        localStorage.setItem('token','');
                        localStorage.setItem('username','');
                        this.$emit('login');
                        this.$router.push('/login');

                })
            });
        }
    }
</script>

<style scoped>

</style>