<template>
    <div>
        <h1>this is hooks</h1>
        <p>My nam is: {{name}}</p>
    </div>
</template>


<script>


export default {
    data() {

        return{
            name: 'mahfuz'
        }
        
    },

    

    created(){
        //call mostly initial data from it ..
    },
    mounted(){
        console.log(); 
    }
}
</script>
