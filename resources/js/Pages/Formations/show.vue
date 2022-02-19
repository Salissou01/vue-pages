<template>
    <app-layout>
        <template #header>
            {{ forms.title }}
        </template>
        <div class="py-8  mx-8" >
            <div class="text-2xl">{{  this.formsShow.episodes[this.currentKey].title }}</div>
            <iframe class="w-full h-screen" :src="this.formsShow.episodes[this.currentKey].video_url"  frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> 
            <div class="text-sm text-gray-500">{{  this.formsShow.episodes[this.currentKey].description }}</div>
            
            <div class="py-6">
                <progress-bar :watched-episodes="watched" :episodes="forms.episodes"  />
            </div>
            <div class="mt-6">
                <ul v-for="(episode, i) in this.formsShow.episodes" v-bind:key="episode.id">
                    <li class="mt-3 flex justify-between items-center">
                        <div>
                            Episode n°{{ i+1 }} - {{ episode.title}} 
                            <button class="text-gray-500 focus:text-indigo-500 outline-none"
                            @click="switchEpisode(i)">Voir l'èpisode</button>
                        </div>
                        <progress-button :episode-id="episode.id" :watched-episodes="watched"/>
                     </li>
                </ul>
            </div> 
        </div>
    </app-layout>
</template>
<script>
import AppLayout from '../../Layouts/AppLayout.vue';
import ProgressButton from './ProgressButton.vue';
import ProgressBar from './ProgressBar';

export default {
    components: {
        
        AppLayout,
        ProgressButton,
        ProgressBar
        
    },

    props: ['forms', 'watched'],

    data(){
        return{
            formsShow: this.forms,
            currentKey: 0
        }
    },
    methods:{
        switchEpisode(i){
           this.currentKey=i;


           window.scrollTo({
               top:0,
               left:0,
               behavior: 'smooth'
           });
        }
    },


    
    mounted(){

        //console.log(this.formList);
    }
}
</script>