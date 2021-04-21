<template>
</template>

<script type="text/javascript">
 export default{
   created(){
       localStorage.removeItem('token');
            localStorage.removeItem('user');
            Toast.fire({
            icon: 'success',
            title: 'Registered and Signed in successfully'
            });
        this.$router.push({name:'/'});
     }
 }
</script>

<style scoped>

</style>
