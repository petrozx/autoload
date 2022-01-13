document.addEventListener('DOMContentLoaded',()=>{
  const root = $('#root')
  const body = $('body')

  const select = document.createElement('select')
  const marks = ['mazda', 'nissan', 'toyota', 'isuzu']
  root.append(select)
  marks.map(e=>{
    const option = document.createElement('option')
    option.textContent = e;
    select.append(option)
  })

  document.querySelector('select').onchange=(e)=>{
    $('.name-car')?.remove()
    const nameA=e.target.value
    create('h1', 'name-car', '#root', '.new-class', nameA)
  }

  create('div', 'new-class','#root', 'select', 'Ваша марка:')

  function $(node) {
    const items = document.querySelectorAll(node)
    if (items.length > 1){
      return items
    } else {
      return items[0]
    }
  }

  function insertAfter(parent, node, referenceNode) {
    parent.insertBefore(node, referenceNode.nextSibling);
}

  function create(tag, classname, parent, after, text="") {
    const el = document.createElement(tag)
    el.innerText = text
    classname&&(el.className = classname)
    insertAfter($(parent), el, $(after))
  }


})
