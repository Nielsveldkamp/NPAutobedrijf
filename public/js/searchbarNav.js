document.addEventListener("DOMContentLoaded", () => {
    
    fetch('/getSearchbar', {
                method: 'post',
                body: new FormData(),
                headers: {
                    'url': '/getSearchbar',
                    "X-CSRF-Token": document.querySelector('input[name=_token]').value
                }
        })
        .then(res => res.json()) // convert 
        .then(json => {

        const types = json.values.types;
        const brandstoffen = json.values.brandstoffen;
        const carrosserieen = json.values.carrosseries;

        const merkSelectSmall = document.querySelector('#merkSmall');
        
            merkSelectSmall.addEventListener('change' ,(event) => {
                console.log(3);
                for( var merk in types){
                    // run for every different brand
                    // if model/type not in brand {add class hiddenSelect}
                    let typeOptions = document.querySelectorAll('.'+merk)
                    
                    if( merk != merkSelectSmall.value && merkSelectSmall.value != ""){
                        for (let typeOption of typeOptions) {
                            typeOption.classList.add('hiddenSelect');
                            typeOption.disabled = true;
                        }
                    }
                    else{
                        for (let typeOption of typeOptions) {
                            typeOption.classList.remove('hiddenSelect');
                            typeOption.disabled = false;
                        }
                    }

                    var merkBrandstoffen=[]
                    if(merk == merkSelectSmall.value  && merkSelectSmall.value != ""){
                        for(auto in types[merk] ){
                            // get all brandstof types for every auto type in brand
                                merkBrandstoffen.push(types[merk][auto].brandstof);
                        }
                    merkBrandstoffen =  Array.from(new Set(merkBrandstoffen));// gets all unique brandstof
                    
                    // als brandstof niet gebruikt word door het gekozen merk {add class hidden/disabled select}
                    for(brandstof in brandstoffen){
                        let brandstofOption = document.querySelector('#'+brandstof)
                            if( !merkBrandstoffen.includes(brandstof)){
                                brandstofOption.classList.add('disabledSelect');
                                brandstofOption.disabled = true;
                            }
                            else{
                                brandstofOption.classList.remove('disabledSelect');
                                brandstofOption.disabled = false;
                            }
                        }
                    }
                    
                    var merkCarrosserieen=[]
                    if(merk == merkSelectSmall.value && merkSelectSmall.value != ""){
                        for(auto in types[merk] ){
                            // get all carrosserie types for every auto type in brand
                            merkCarrosserieen.push(types[merk][auto].carrosserie);
                        }
                        merkCarrosserieen =  Array.from(new Set(merkCarrosserieen));// gets all unique brandstof
                    
                    // als carrosserie niet gebruikt word door het gekozen merk {add class hidden/disabled select}
                    for(carrosserie in carrosserieen){
                        let carrosserieOption = document.querySelector('#'+carrosserie)
                            if( !merkCarrosserieen.includes(carrosserie)){
                                carrosserieOption.classList.add('disabledSelect');
                                carrosserieOption.disabled = true;
                            }
                            else{
                                carrosserieOption.classList.remove('disabledSelect');
                                carrosserieOption.disabled = false;
                            }
                        }
                    }
                }
            })
        }); 
    });