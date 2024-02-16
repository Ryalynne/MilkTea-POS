
var script = document.createElement('script');
script.src = 'https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js';

script.onload = function () {
    const newTagsInput = document.getElementById('newTagsInput');
    const newTagsContainer = document.getElementById('tagsContainer');

    function createTag(tagText, categoryText, price) {
        const tagElement = document.createElement('span');
        tagElement.textContent = `${tagText} (${categoryText}) (${price})`;
        tagElement.classList.add('tag', 'inline-block', 'bg-gray-200', 'text-gray-700', 'rounded', 'px-2', 'py-1', 'mr-2', 'mb-2');

        const removeButton = document.createElement('button');
        removeButton.innerHTML = '&times;';
        removeButton.classList.add('tag-remove');

        removeButton.addEventListener('click', function () {
            totalCost -= parseFloat(price)
            const costPriceInput = document.getElementById('disabled-input-2');
            costPriceInput.value = totalCost.toFixed(2);
            console.log('deleted', totalCost);
            newTagsContainer.removeChild(tagElement);
        });

        tagElement.appendChild(removeButton);

        return tagElement;
    }
    let totalCost = 0;

    newTagsInput.addEventListener('keyup', function (event) {
        if (event.key === ',') {
            const tags = newTagsInput.value.split(',');
            const categoryElement = document.getElementById('tagsInput');
            const category = categoryElement ? categoryElement.value : '';
            console.log("Category:", category);

            if (category) {
                const valuesArray = category.split(/₱/);
                console.log("Values Array:", valuesArray);

                if (valuesArray.length === 3) {
                    const value1 = valuesArray[0].trim();
                    const value2 = valuesArray[1].trim();
                    const value3 = valuesArray[2].trim();
                    console.log("Value 1:", value1);
                    console.log("Value 2:", value2);
                    console.log("Value 3:", value3);
                    tags.forEach(tag => {
                        const trimmedTag = tag.trim();
                        if (trimmedTag) {
                            // Ensure that parseFloat(value2) is correctly parsed
                            let expenses = parseFloat(value2) / parseInt(value3)
                            console.log("expenses:", expenses);
                            totalCost += parseInt(trimmedTag) * parseFloat(expenses);
                            let currentTotal = parseInt(trimmedTag) * parseFloat(expenses);
                            const tagElement = createTag(trimmedTag, value1, currentTotal);
                            console.log("Created tag element for:", trimmedTag);
                            console.log(tagElement);
                            // Update total cost input field
                            const costPriceInput = document.getElementById('disabled-input-2');
                            costPriceInput.value = totalCost.toFixed(2);
                            console.log("totalCost:", totalCost);

                            // Append tag element


                            newTagsContainer.appendChild(tagElement);

                            // Reset newTagsInput value
                            newTagsInput.value = '';
                        }
                    });
                } else {
                    console.error("Category does not contain two values separated by '₱'");
                }
            } else {
                console.error("Category value is empty");
            }
        }
    });
    // newTagsInput.addEventListener('keyup', function (event) {
    //     if (event.key === ',') {
    //         const tags = newTagsInput.value.split(',');
    //         const category = document.getElementById('tagsInput').value;
    //         const valuesArray = category.split(" ₱ ");
    //         const value1 = valuesArray[0];
    //         const value2 = valuesArray[1];

    //         tags.forEach(tag => {
    //             const trimmedTag = tag.trim();
    //             if (trimmedTag) {
    //                 const tagElement = createTag(trimmedTag, value1);
    //                 newTagsContainer.appendChild(tagElement);
    //             }
    //         });


    //         // ₱{{$item->price}} 

    //         // const categoryName = data.recipe.recipe_name;
    //         // $.get("/find-recipe/" + category, function (data, status) {
    //         //     const categoryName = data.recipe.recipe_name;
    //         //     tags.forEach(tag => {
    //         //         const trimmedTag = tag.trim();
    //         //         if (trimmedTag) {
    //         //             const tagElement = createTag(trimmedTag, categoryName);
    //         //             newTagsContainer.appendChild(tagElement);
    //         //         }
    //         //     });
    //         //     newTagsInput.value = '';
    //         // });


    //         newTagsInput.value = '';
    //     }
    // });
};

// Append the <script> element to the <head> of the document
document.head.appendChild(script);
