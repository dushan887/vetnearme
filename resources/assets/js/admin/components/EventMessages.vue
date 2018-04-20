<template>

    <div :class="['alert', 'alert-' + classType, 'alert-dismissible']" v-if="visible">
        <button type="button" class="close" @click="hide">×</button>
        <h4><i class="icon fa fa-check"></i>{{ messageTitle }}</h4>
        {{ messageText }}
    </div>
  
</template>

<script>
export default {
  data(){
      return {
          classType: 'success',
          visible: false,
          messageTitle: '',
          messageText: ''
      }
  },
  methods: {
      show(message, classType){

          this.messageTitle = message.messageTitle
          this.messageText  = message.messageText
          this.visible         = true

      },
      hide(){
          this.messageTitle = ''
          this.messageText  = ''
          this.visible         = false
      }
  },
  mounted(){
      Event.$on('message:show', (message, classType) => {
          this.show(message, classType)
      })
  }
}
</script>

