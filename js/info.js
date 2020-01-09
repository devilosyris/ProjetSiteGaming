window.onload = fetch('../../js/info.json')
  .then(response => {
  	return response.json();	
  })
  // data (reponse.json)
  .then(data => {
    document.querySelector('title').textContent = data.title;
     document.querySelector('meta[name="description"]').setAttribute("content", data.description);
    console.log(data.title);
   
  })