<template>

    <div class="modal fade" tabindex="-1" role="dialog" id="main-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <span v-html="body"></span>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

</template>

<script>
    export default {
        methods: {
            test(){
                alert(1)
            }
        },
        data(){
            return {
                body: ''
            }
        },
        mounted(){

            let mainModal = $('#main-modal')

            Event.$on('modal:show', (html) => {
                this.body = html
                mainModal.modal('show')
            })

            Event.$on('modal:hide', () => {
                mainModal.modal('hide')
            })

        }
    }
</script>
