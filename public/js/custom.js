

/**
 * 
 * @param {type} id
 * @returns {undefined}
 */
const absent = (t) => {

    /**
     * 
     * @type Document.location.host
     */
    var url = document.location.host;

    /**
     * 
     * @param {type} url
     * @param {type} data
     * @returns {unresolved}
     */
    async function postData(url = "", data = {}) {

        try {
            /**
             * 
             * @type type
             */
            const response = await fetch(url + '/' + data.id + '/' + data.value, {
                method: "GET", 
                mode: "no-cors",
                cache: "no-cache", 
                credentials: "include", 
                headers: {
                    "Content-Type": "application/json",
                },
                redirect: "follow", 
                referrerPolicy: "no-referrer"
            });
            return await response.json();
        } catch (error) {
            console.error("Error:", error);
        }
    }

    var value = 0;
    var id = t.getAttribute('data-value');
    if( t.checked === true) { value = 1; }

    /**
     * 
     */
    postData("/players/absent", { id: id, value: value} ).then((data) => {        
        if(data === true && value === 1) {
            t.parentElement.parentElement.children.absent.innerHTML = 'Sim';
        } else {
            t.parentElement.parentElement.children.absent.innerHTML = 'Não';
        }
    });
    
};

const remove = (t) => {

    async function removeData(url = "", data = {}) {

        try {
            /**
             * 
             * @type type
             */
            const response = await fetch(url + '/' + data.id , {
                method: "GET", 
                mode: "no-cors",
                cache: "no-cache", 
                credentials: "include", 
                headers: {
                    "Content-Type": "application/json",
                },
                redirect: "follow", 
                referrerPolicy: "no-referrer"
            });
            return await response.json();
        } catch (error) {
            console.error("Error:", error);
        }
    }

    var id = t.getAttribute('data-value');

    /**
     * 
     */
    removeData("/players/remove", { id: id} ).then((data) => {       
        if (confirm("Deseja remover esse Jogador!") === true) {
            if(data === true) {
                t.parentElement.parentElement.remove();
            }
        }
    });

};

