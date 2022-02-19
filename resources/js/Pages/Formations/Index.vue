<template>
    <app-layout>
        <template #header>
            Liste des formations
        </template>
        <div class="py-3" v-for="form in this.formList" v-bind:key="form.id">
            <div class="mx-8  bg-white p-4 rounded shadow">
                <div class="text-sm text-gray-500"> mise en ligne par{{  form.user.name }} <span class="text-gray-500 text-sm">{{ form.participants }} participant
                <span v-if="parseInt(form.participants)> 1">s</span>
                 </span></div>
                <div class="flex justify-between items-center">
                    <div class="text-4xl">{{  form.title }}</div>
                    <div class="text-sm text-gray-400">{{form.episodes_count}} episodes </div>
                </div>
                <div class="text-sm text-gray-500">{{  form.description }}</div>
               
                <div class="flex items-center justify-between">
                     <a :href="'formations/' + form.id" class="bg-indigo-500 text-white px-2 py-1 text-sm mt-3 inline-block rounded hover:bg-indigo-700">Voir la formation</a>
                    <a :href="'courses/edit/' + form.id" v-if="form.update" class="bg-gray-500 text-white px-2 py-1 text-sm mt-3 inline-block rounded hover:bg-gay-700">Modifier la formation</a>
                </div>
            </div>
            
        </div>
    </app-layout>
</template>
<script>
import AppLayout from '../../Layouts/AppLayout.vue';

export default {
    components: {
        
        AppLayout
        
    },

    props: ['form'],

    data(){
        return{
            formList: this.form
        }
    },


    
    mounted(){
        console.log(this.formList);
    }
}
</script>