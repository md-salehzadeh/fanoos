<template>
	<div>
		<v-breadcrumbs :items="breadcrumbs">
			<template v-slot:divider>
				<v-icon>chevron_left</v-icon>
			</template>
		</v-breadcrumbs>

		<div class="title font-weight-light" id="page-title">
			<v-icon medium color="blue darken-2">view_modules</v-icon> ماژول ها
		</div>

		<template>
			<v-form ref="form">
				<v-text-field v-model="module_title" label="عنوان" required></v-text-field>

				<v-text-field label="انتخاب فایل" @click='pickFile' v-model='module_filename' prepend-icon='attach_file'></v-text-field>
				<input type="file" style="display: none" ref="module_file" accept="" @change="onFilePicked">

				<v-btn color="success" @click="install_module">
					نصب ماژول
				</v-btn>
			</v-form>
		</template>
	</div>
</template>


<script>
	export default {
		mounted() {

		},
		data() {
			return {
				breadcrumbs: [{
						text: 'داشبورد',
						disabled: false,
						href: '/admin/home'
					},
					{
						text: 'ماژول ها',
						disabled: false,
						href: '/admin/modules'
					},
					{
						text: 'افزودن',
						disabled: true,
						href: '/admin/modules/add'
					}
				],

				module_title: '',
				module_file: '',
				module_filename: '',
			};
		},
		computed: {

		},
		methods: {
			pickFile() {
				this.$refs.module_file.click()
			},

			onFilePicked(e) {
				const files = e.target.files
				if (files[0] !== undefined) {
					this.module_filename = files[0].name
					if (this.module_filename.lastIndexOf('.') <= 0) {
						return
					}
					const fr = new FileReader()
					fr.readAsDataURL(files[0])
					fr.addEventListener('load', () => {
						this.module_file = files[0] // this is an image file that can be sent to server...
					})
				} else {
					this.module_filename = ''
					this.module_file = ''
				}
			},

			install_module() {
				var formData = new FormData();
				formData.append("module_file", this.module_file);
				axios.post('/api/admin/modules/install', formData, {
					headers: {
						'Content-Type': 'multipart/form-data'
					}
				})
				.then(response => {

				});
			}
		}
	};
</script>