document.addEventListener('DOMContentLoaded',()=>{
  const root = $('#root')
  const body = $('.wrapper')

  const select = document.createElement('select')
  const marks = ['mazda', 'nissan', 'toyota', 'isuzu']
  root.append(select)
  marks.map(e=>{
    const option = document.createElement('option')
    option.textContent = e;
    select.append(option)
  })
  let nameA=''
  const div = document.createElement('div')
  document.querySelector('select').onchange=(e)=>{
    nameA=e.target.value
    div.textContent=nameA
  }
  insertAfter(body,div, root)

  function insertAfter(parent, node, referenceNode) {
    parent.insertBefore(node, referenceNode.nextSibling);
}


  function $(node) {
    const items = document.querySelectorAll(node)
    if (items.length > 1){
      return items
    } else {
      return items[0]
    }
  }
create('div', '#root', 'Ваша марка:')

  function create(elem, node, text) {
    const el = document.createElement(elem)
    el.innerText = text
    insertAfter(body, el, $(node))
  }


})