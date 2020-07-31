const API = "http://localhost/tree-list/getdata.php";
const DEEP = 3;
function treeBuilder(parent, node) {
    axios.get(API + "?parent=" + parent).then(
        result => {
            let dataset = result.data;
            if (dataset === null || !dataset) return false;
            if (document.getElementById(node)) {
                document.getElementById(node).innerHTML += dataset;
                setWidth();
                document.getElementById('ptxPluss').addEventListener('click', function () {
                    let itemArr = document.getElementsByClassName('ptx_last_child');
                    for (const item of itemArr) {
                        let dataID = item.dataset.id;
                        if (dataID) {
                            let idElement = 'treeSub-' + dataID;
                            let htmlexists = document.getElementById(idElement).querySelector('li[data-search="1"]');
                            if(htmlexists === null)
                                treeBuilder(dataID, idElement);
                        }
                    }
                    let clerElm = document.querySelectorAll('.ptx_last_child');
                    for (let index = 0; index < clerElm.length; index++) {
                        const element = clerElm[index];
                        element.classList.remove('ptx_last_child');
                    }
                });
            }
        }
    )
}
treeBuilder(0, 'ptxtreelist');

document.getElementById('ptxsearch-input').addEventListener('keyup', delay(function (e) {
    let key = this.value;
    // send request
    axios.post(API + "?find=" + key)
        .then(
            result => {
                let data = result.data;
                buildTreeSub(16);
            }
        );
}, 1000));

function delay(callback, ms) {
    let timer = 0;
    return function() {
        var context = this, args = arguments;
        clearTimeout(timer);
        timer = setTimeout(function () {
            callback.apply(context, args);
        }, ms || 0);
    };
}

function buildTreeSub(id){
    let lastNode = [];
    let itemArr = document.getElementsByClassName('ptx_last_child');
    for (const item of itemArr) {
        let dataID = item.dataset.id;
        lastNode.push(dataID);
    }
    const headers = {
        'Content-Type': 'application/json',
    }
    let bodyFormData = new FormData();
    bodyFormData.set('lastNode', JSON.stringify(lastNode));
    bodyFormData.set('idNode' , id);
    axios.post("http://localhost/tree-list/search.php", bodyFormData)
        .then(
            response => {
                let data = response.data;
                let node = 'treeSub-'+data.id;
                let dataset = data.data;
                if (document.getElementById(node)) {
                    let htmlexists = document.getElementById(node).querySelector('li[data-search="1"]');
                    if(htmlexists === null)
                        document.getElementById(node).innerHTML += dataset;
                }

                let searchOld = document.querySelector('.searchResult');
                if(searchOld)
                    searchOld.classList.remove('searchResult');
                document.querySelector('li[data-id="'+ id +'"]').scrollIntoView();
                document.querySelector('li[data-id="'+ id +'"]').classList.add('searchResult');
                // document.querySelector('li[data-id="'+ id +'"]').children[0].style.border = "solid thin #fc9923";
                // document.querySelector('li[data-id="'+ id +'"]').children[0].style.borderTop = "6px solid #fc9923";
                // document.querySelector('li[data-id="'+ id +'"]').children[0].style.boxShadow = "0 2.8px 2.2px rgba(0, 0, 0, 0.034), 0 6.7px 5.3px rgba(0, 0, 0, 0.048), 0 12.5px 10px rgba(0, 0, 0, 0.06), 0 22.3px 17.9px rgba(0, 0, 0, 0.072), 0 41.8px 33.4px rgba(0, 0, 0, 0.086), 0 100px 80px rgba(0, 0, 0, 0.12)";
            }
        )
}

function  setWidth() {
    let w = document.getElementsByClassName('ptx-tree__item')[0].offsetWidth;
    w = DEEP * w + 20*(DEEP + 1);
    document.getElementById('ptxtreelist').style.width = w + document.getElementById('ptxtreelist').offsetWidth;
    document.getElementById('ptxtreelist').style.overflowX = "scroll";
}