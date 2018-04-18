const Form = {

    showErrors(form, errors){

        this.removeErrors(form)

        for(let error in errors){

            let errorMessages = errors[error]
            let errorGroup    = $('div[data-group=' + error + ']')

            errorGroup.addClass('has-error')

            for(index in errorMessages){
                errorGroup.append(`<span class="help-block">${errorMessages[index]}</span>`)
            }

        }
    },

    removeErrors(form){

        let oldErrors = form.find('.has-error')

        oldErrors.find('span.help-block').remove()
        oldErrors.removeClass('has-error')
        
    }

}

module.exports = Form;