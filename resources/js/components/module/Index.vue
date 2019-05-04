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
			<v-data-table :headers="headers" :items="modules" class="elevation-1">
				<template v-slot:items="props">
					<td class="text-xs-center">{{ props.item.name }}</td>
					<td class="text-xs-center">{{ props.item.title }}</td>
					<td class="text-xs-center">{{ props.item.description }}</td>
					<td class="text-xs-center">{{ props.item.version }}</td>
					<td class="text-xs-center">{{ props.item.active ? 'فعال' : 'غیرفعال' }}</td>
					<td class="text-xs-center">{{ props.item.release_date }}</td>
				</template>
			</v-data-table>
		</template>
	</div>
</template>


<script>
	export default {
		components: {

		},
		mounted() {
			axios
				.get('/api/admin/modules')
				.then(response => {
					this.modules = response.data;
				});
		},
		data() {
			return {
				modules: [],
				headers: [{
						text: 'نام سیستمی',
						value: 'name',
						align: 'center',
					},
					{
						text: 'عنوان',
						value: 'title',
						align: 'center',
					},
					{
						text: 'توضیحات',
						value: 'description',
						align: 'center',
					},
					{
						text: 'ورژن',
						value: 'version',
						align: 'center',
					},
					{
						text: 'وضعیت',
						value: 'active',
						align: 'center',
					},
					{
						text: 'تاریخ انتشار',
						value: 'release_date',
						align: 'center',
					}
				],
				breadcrumbs: [{
						text: 'داشبورد',
						disabled: false,
						href: 'breadcrumbs_dashboard'
					},
					{
						text: 'ماژول ها',
						disabled: true,
						href: 'breadcrumbs_link_1'
					}
				]
			};
		},
		computed: {

		},
		methods: {

		}
	};
</script>