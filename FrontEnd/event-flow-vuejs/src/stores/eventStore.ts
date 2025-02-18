import { defineStore } from "pinia";
import {getAllEvent} from "@/services/eventService.ts";
import type {EventStore} from "@/interfaces/type.ts";

export const eventStore = defineStore('eventStore',{
    state: () => ({
      event: [] as Array<EventStore>
    }),
    actions : {
      async getAllEventStore(){
        const event = await getAllEvent();
        this.event = event.data;
        console.log(this.event);
      },
    },
    getters: {

    }
});
