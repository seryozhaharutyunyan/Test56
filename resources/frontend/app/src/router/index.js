import { createRouter, createWebHistory } from 'vue-router'
import FeedbackView from "@/views/FeedbackView.vue";
import SaveMethodView from "@/views/SaveMethodView.vue";

const routes = [
  {
    path: '/feedback',
    name: 'feedback',
    component: FeedbackView
  },

    {
    path: '/method',
    name: 'method',
    component: SaveMethodView
  },
]

const router = createRouter({
  history: createWebHistory('/'),
  routes
})

export default router
