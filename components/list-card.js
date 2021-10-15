class ListCard extends HTMLElement {
    constructor() {
        super();
    }

    connectedCallback() {
        const isFinalIndex = this.attributes.final.value;
        const name = this.attributes.name.value.replaceAll("%20", " ");
        const description = this.attributes.description.value.replaceAll("%20", " ");
        const sold = this.attributes.sold.value.replaceAll("%20", " ");
        const price = this.attributes.price.value.replaceAll("%20", " ");
        const stock = this.attributes.stock.value.replaceAll("%20", " ");

        this.innerHTML = `
            <a class="card-href" href="detail.php">
                <div class=${
                    isFinalIndex ? "card-container-final" : "card-container"
                }>
                    <img class="card-thumbnail" src="https://asset.kompas.com/crops/8mYWlI9lPaf8F7XDmQOi2Rte9jo=/0x0:1000x667/750x500/data/photo/2021/07/23/60fa5f58ea527.jpg" alt="Avatar"/>
                    <div class="card-info">
                        <h4 class="card-title">${name}</h4>
                        <p class="card-sold">Terjual: ${sold} buah</p>
                        <p class="card-desc">${description}</p>
                    </div>
                </div>
            </a>
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

                .card-thumbnail {
                    width: 110px;
                    height: 120px;
                    object-fit: cover;
                    margin-right: 20px;
                    border-radius: 5px;
                }

                .card-info {
                    display: -webkit-box;
                    -webkit-line-clamp: 3;
                    -webkit-box-orient: vertical;
                    overflow: hidden;
                    text-overflow: ellipsis;
                }

                .card-title {
                    font-weight: bold;
                    -webkit-margin-before: .4rem;
                    -webkit-margin-after: .5rem;
                }

                .card-desc {
                    color: #757575;
                    font-size: .85em;
                }

                .card-sold {
                    font-size: .85em;
                    margin-block-start: 1em;
                    margin-block-end: .4rem;
                }
            </style>
        `;
    }
}

customElements.define("list-card", ListCard);
