import $axios from "./store/axios-instance";

const config = {
	apiKey: '3altvx3o58s3m9c91n0rkkakz44erl8m2ccwhp8uq0og49ed',
	newsInit: {
		height: 500,
		plugins: 'paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen ' +
			'link codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount textpattern ' +
			'noneditable help charmap emoticons image',
		toolbar: 'undo redo | bold italic underline strikethrough | ' +
			'superscript subscript | ' +
			'fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | ' +
			'outdent indent |  numlist bullist | forecolor backcolor removeformat | charmap emoticons | fullscreen | ' +
			'link anchor codesample | table tabledelete | tableprops tablerowprops tablecellprops | ' +
			'tableinsertrowbefore tableinsertrowafter tabledeleterow | tableinsertcolbefore tableinsertcolafter tabledeletecol | image',
		images_upload_url: '/api/admin/news-image-store',
		images_upload_handler: function (blobInfo, success, failure) {
			const formData = new FormData();
			formData.append('file', blobInfo.blob(), blobInfo.filename());

			$axios.post('/admin/news-image-store', formData)
				.then((response) => {
					success(response.data.location);
				})
				.catch(response => {
					if (response.status === 422) {
						const fails = response.data.errors;
						failure(fails.file[0]);
					}
				})
		},
	},
};

export default config;
