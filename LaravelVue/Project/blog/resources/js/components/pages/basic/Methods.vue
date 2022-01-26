<template>
    <div>
        <h1>The number is {{views}}</h1>
        <button @click="updateCounter(1)">+</button>
        <button @click="updateCounter(-1)">-</button>
        <br>
        <br>
        <br>

        <div v-for="(blog, i) in blogs" :key="i">
            <h1>{{blog.title}}</h1>
            <p>{{blog.post}}</p>

        </div>

        <br>
        <br>
        <br>

        <div>
            <h1 v-if="showItem"> sho item true</h1>
            <h1 v-else> sho item false</h1>
        </div>

        <button @click="changeShowItem">Change item</button>



    </div>
</template>


<script>


export default {
    data(){
        return{
            views: 0,
            blogs : [
                
            ],
            showItem: false
        }
    },
    methods: {
        updateCounter(number){
            this.views += number
        },
        changeShowItem(){
            this.showItem=!this.showItem
        }
        
    },

    created(){
        this.views = 100
        let posts =  [
                {title: "this is title 1" , 'post' : 'this is post  1', id: 1},
                {title: "this is title 2" , 'post' : 'this is post 2', id: 2},
                {title: "this is title 3" , 'post' : 'this is post 3', id: 3},
                {title: "this is title 4" , 'post' : 'this is post 4', id: 4}
            ]

            this.blogs = posts
    }
}
</script>
