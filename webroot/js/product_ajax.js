$('#edit-product').validate({

    rules: {
        
        product_title: {
            required: true,
        },
        product_description: {
            required: true,
        },
        product_category: {
            required: true,
        },
        product_description: {
            required: true,
        },
        product_image: {
            required: true,
        },
        product_tags: {
            required: true,
        },
        category_name: {
            required: true,
        }
    },

    messages: {
        
        product_title: {
            required: "**Please enter Product Title",
        },
        product_description: {
            required: "Please enter Product Description",
        },
        product_category: {
            required: "Please enter Product Category",
        },
        product_image: {
            required: "Please Select Image",
        },
        product_tags: {
            required: "Please enter Product Tags",
        },
        category_name: {
            required: "Please enter category name",
        },

    }
});