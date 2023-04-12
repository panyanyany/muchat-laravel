export class SlugInput extends window.Controller {

    static get targets() {
        return ["name", "value"]
    }

    connect() {
    }

    generate() {
        let slug = generateSlug(7)
        slug = 'c' + slug.toLowerCase()
        console.log(this.valueTarget.value = slug)
    }
}
