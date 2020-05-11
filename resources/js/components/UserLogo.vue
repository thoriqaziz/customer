<template>
    <div class="btn rounded border text-white bg-primary align-items-center" style="height: 40px; width: 40px;"> 
        <center>{{ userLogo }}</center>
    </div>
</template>

<script>
export default {
    name: "UserLogo",

    props: ['name'],

    computed: {
        userLogo: function () {
            return this.name.substring(0, 2);
        }
    }
}
</script>