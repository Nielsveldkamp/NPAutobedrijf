
    function deleteFile(id){
        
        if (confirm("weet u het zeker?") == true) {
            imgElement = document.querySelector('#img'+id);
            imgElement.remove();
        fetch('/deleteFile/'+id, {
            method: 'DELETE',
            body: new FormData(),
            data: {
                "id": id // method and token not needed in data
            },
            headers: {
                'url': '/deleteFile',
                "X-CSRF-Token": document.querySelector('input[name=_token]').value
            }
        })
        }
    } 