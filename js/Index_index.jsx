
  async function getAllUsers() {
    const resp = await fetch('/api/login/userAuth', {
      method: 'POST'
    })
    return await resp.json()
  }


function App() {
const fifa = React.useRef();
  
  React.useEffect(async()=>fifa = await getAllUsers())

  console.log(fifa);
  return(
    <h1>Привет, мир!</h1>
  )
}


ReactDOM.render(
    <App/>,
    document.getElementById('root')
  );