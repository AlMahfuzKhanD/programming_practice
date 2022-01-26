<template>
    <div class="container"> 
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="collapse navbar-collapse">
                <div class="navbar-nav">
                 
                    <router-link to="/create" class="nav-item nav-link">Create Product</router-link>
                    <router-link to="/hooks" class="nav-item nav-link">Hook</router-link>
                    <router-link to="/methods" class="nav-item nav-link">Method</router-link>
         
                </div>
            </div>
        </nav>

        <router-view> </router-view>
    </div>
</template>
 
<script>
    export default {}
</script>