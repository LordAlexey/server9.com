<template>
    <div>
        Upload file with info
        <input type="text" placeholder="text" v-model="text">
        <input type="file" v-on:change="upFile">
        <img :src="src" width="100" alt="">
        <button v-on:click="upload">Upload</button>

        <a href="" v-on:click.prevent="download">Download file</a>
        Image: <img :src="dsrc" width="200" alt="">
    </div>
</template>

<script type="text/ecmascript-6">
    export default {
        name: "test",
        props:['token'],
        data() {
            return {
                text:'',
                file:'',
                src:'',
                dsrc:''
            }
        },
        mounted() {
          console.log(this.$parent);
        },
        methods: {
            upload() {
                var form = new FormData();
                form.append('text',this.text);
                form.append('file',this.file);

                fetch('http://server9.com/BY_JS-PHP_A/api/v1/fetch/upload?token='+this.token,
                    {
                        method:'post',
                        // headers:new Headers({'content-type':'form-data'}),
                        body:form
                    }).then(res=>{
                        res.json().then(data=>{

                            if(res.ok) {
                                console.log('ok');
                                console.log(data);
                            }
                            else {
                                console.log('bad');
                            }

                        })
                })


            },
            upFile(ev) {
                var file = ev.target.files[0];
                this.file = file;
                var reader = new FileReader();
                var self = this;
                reader.readAsDataURL(file);
                reader.onload = function (ev2) {
                    self.src = ev2.target.result;
                }
            },
            download() {
                fetch('http://server9.com/BY_JS-PHP_A/api/v1/fetch/download?token='+this.token,{
                    method:'get'
                }).then(res=> {
                    res.blob().then(data=>{
                        console.log(data);

                        var file = new Blob([data]);
                        var url = window.URL.createObjectURL(file);
                        this.dsrc = url;
                        var link = document.createElement('a');
                        link.setAttribute('href',url);
                        link.setAttribute('download','photo.png');
                        link.click();
                        link.remove();

                    })
                })
            }
        }
    }
</script>

<style scoped>

</style>