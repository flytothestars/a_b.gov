export const acceptableFiles = [
	'image/png',
	'image/jpeg',
	'application/msword',
	'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
	'application/zip',
	'application/x-zip-compressed',
	'application/pdf',
];

export const makeFilesFormDateFormJson = (object) => {
	var formData = new FormData();

	const fields = Object.keys(object);

	for (let field of fields) {
		if (
			field === 'files'
			&& Array.isArray(object[field])
		) {
			for (let fileIndex in object[field]) {
				if(object[field].hasOwnProperty(fileIndex)){
					formData.append(`files[${fileIndex}]`, object[field][fileIndex]);
				}
			}
		} else if(object[field]) {
			formData.append(field, object[field]);
		}
	}

	return formData;
}

export const flatMultipleFilesErrors = (files, errors) => {
	const filesErrors = [];

	if (files && files.length) {

		for (let file in files) {
			if (files.hasOwnProperty(file)) {
				const index = `files.${file}`;
				if (errors && errors[index]) {
					if (Array.isArray(errors[index]) && errors[index].length) {
						filesErrors.push(errors[index][0]);
					}
				}
			}
		}
	}
	return filesErrors;
}

export const processFileFormErrors = (payload, error, resolve, reject) =>
{
	if (error.status === 422) {
		const errors = error.data.errors;

		if (payload.files && payload.files.length) {
			const filesErrors = flatMultipleFilesErrors(payload.files, errors);

			resolve({
				fails: {
					...errors,
					files: filesErrors,
				}
			});
		}
		resolve({
			fails: errors
		});

	} else {
		console.log(error)
		reject(error)
	}
}

export default {
	acceptableFiles
};
