<template>
    <div>
        <div class="services-actions">
            <button type="button" class="btn btn-primary">Add Service</button>
        </div>
        <div class="services"></div>
    </div>
</template>

<script>
export default {
    methods: {
        getAll(){
            axios.get('/admin/services/all', {})
            .then((response) => {
                console.log(response);
                
            })
        }
    }
}
</script>
