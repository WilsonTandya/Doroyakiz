class HistoryCard extends HTMLElement {
    constructor() {
        super();
    }

    numberWithCommas(x) {
        let parts = x.toString().split(".");
        parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        return parts.join(".");
    }

    connectedCallback() {
        const bookIndex = Number(this.getAttribute("index"));
        const bookQuantity = Number(this.getAttribute("quantity"));
        const isFinalIndex = this.getAttribute("final");

        this.innerHTML = `
            <style>
                .card-href {
                    text-decoration: none;
                    color: #000;
                }

                .card-container, .card-container-final {
                    display: flex;
                    align-items: center;
                    border-top: 2px solid rgba(0,0,0,0.15);
                    margin: 0px 0;
                    padding: 15px 15px;
                    cursor: pointer;
                    transition-duration: .15s;
                }

                .card-container:hover, .card-container-final:hover {                
                    background: rgb(240, 240, 240);
                    transition-duration: .15s;
                }

                .card-container-final {
                    border-bottom: 2px solid rgba(0,0,0,0.15);
                }

                .cart-thumbnail {
                    width: 110px;
                    height: 120px;
                    object-fit: cover;
                    margin-right: 20px;
                    border-radius: 5px;
                }

                .cart-title {
                    font-weight: normal;
                    -webkit-margin-before: .4rem;
                    -webkit-margin-after: .5rem;
                }

                .cart-writer {
                    color: #757575;
                    font-size: .85em;
                }

                .cart-price {
                    font-weight: bold;
                    margin-block-start: 1em;
                    margin-block-end: .4rem;
                }

                .add-container {
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                }

                #book-choice {
                    color: #FF6700;
                    -webkit-margin-before: .1rem;
                    -webkit-margin-after: .2rem;
                }

                .delete-icon {
                    width: 20px;
                    height: 20px;
                    transition: 0.1s;
                    margin-right: 20px;
                    opacity: 0.6;
                }

                .delete-icon:hover {
                    cursor: pointer;
                    opacity: 1;
                }

                .flex-row {
                    display: flex;
                    align-items: center;
                }

                .shopping-card {
                    display: flex;
                    flex-direction: column;
                    justify-content: space-between;
                    width: 250px;
                    height: 200px;
                    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
                    margin: 100px 0 0 5%;
                    border-radius: 5px;
                    padding: 30px;
                }
                
                #shopping-card-title {
                    margin-block-start: 0;
                    margin-block-end: 1.33em;
                }
                
                .shopping-card-add-container {
                    display: flex;
                    flex-direction: row;
                    flex: 1;
                }
                
                .shopping-card-add-container .add-button {
                    
                    border-radius: 50%;
                    width: 21px;
                    height: 21px;
                    line-height: 21px;
                
                    font-size: 24px;
                    text-align: center;
                    border: 2px solid #FF6700;
                    color: #FF6700;
                    transition: 0.1s;
                }
                
                .shopping-card-add-container .add-button:hover {
                    cursor: pointer;
                    opacity: 0.8;
                }
                
                .shopping-card-add-container input {
                    outline: 0;
                    border-width: 0 0 2px;
                    border-color: rgba(0,0,0,0.2);
                    transition: 0.1s;
                    width: 50px;
                    text-align: center;
                    font-size: 1rem;
                  }
                
                .shopping-card-add-container input:focus {
                    border-color: rgba(0,0,0,0.4);
                }
            </style>
            <a class="card-href" href="detail.php">
                <div class=${
                    isFinalIndex ? "card-container-final" : "card-container"
                } >
                    <img class="cart-thumbnail" src="https://asset.kompas.com/crops/8mYWlI9lPaf8F7XDmQOi2Rte9jo=/0x0:1000x667/750x500/data/photo/2021/07/23/60fa5f58ea527.jpg" alt="Avatar"/>
                    <div style="flex: 1;">
                        <h4 class="cart-title">Doroyaki Norimitsu</h4>
                        <p class="cart-writer">Agustinus Suparjono</p>
                        <p class="cart-price">15 Februari 2021</p>
                    </div>
                </div>
            </a>
        `;
    }
}

customElements.define("history-card", HistoryCard);
