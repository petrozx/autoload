


function App() {
const [fifa, setFifa] = React.useState([]);

  React.useEffect(() => {
    fetch('/api/login/userAuth', {
      method: 'POST'
    }).then(res => res.json()).then(result => {setFifa(result)})
  },[])

  return(
    <h1>Привет, мир! Я пользователь {fifa['success']}</h1>
  )
}


ReactDOM.render(
    <App/>,
    document.getElementById('root')
  );