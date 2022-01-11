

async function getAllUsers() {
  const resp = await fetch('/api/login/userAuth', {
    method: 'POST'
  })
  return resp.json()
}


function App() {
  const res = await React.useMemo(getAllUsers,['success'])
  console.log(res);
  return(
    <h1>Привет, мир!</h1>
  )
}


ReactDOM.render(
    <App/>,
    document.getElementById('root')
  );