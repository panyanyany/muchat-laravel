export class InlineEditor extends window.Controller {

    static get targets() {
        return ["field"]
    }

    change() {
        console.log(this.fieldTarget.name, this.fieldTarget.value, this.fieldTarget.dataset.update_url)
        axios.post(this.fieldTarget.dataset.update_url, {
            [this.fieldTarget.name]: this.fieldTarget.value
        }).then(response => {
            console.log(response)
            toastr.success('修改成功')
        }).catch(error => {
            console.log('error', error)
            toastr.error(error.message, error.name)
        })
    }
}
