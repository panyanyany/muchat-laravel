export class InlineEditor extends window.Controller {

    static get targets() {
        return ["name", "value"]
    }

    greet() {
        console.log(this)
        console.log(this.nameTarget.value)
    }
}
