<template>
	<div>
		<div class="title font-weight-light" id="page-title"><v-icon medium color="blue darken-2">home</v-icon> داشبورد مدیریت</div>

		<v-layout row wrap>
			<v-flex v-for="i in 2" :key="`4${i}`" xs6>
				<v-card class="mx-auto text-xs-center" color="green" dark max-width="600">
					<v-card-text>
						<v-sheet color="rgba(0, 0, 0, .12)">
							<v-sparkline :value="value" color="rgba(255, 255, 255, .7)" height="100" padding="24" stroke-linecap="round" smooth>
								<template v-slot:label="item">
									${{ item.value }}
								</template>
							</v-sparkline>
						</v-sheet>
					</v-card-text>

					<v-card-text>
						<div class="display-1 font-weight-thin">Sales Last 24h</div>
					</v-card-text>

					<v-divider></v-divider>

					<v-card-actions class="justify-center">
						<v-btn block flat>Go to Report</v-btn>
					</v-card-actions>
				</v-card>
			</v-flex>
		</v-layout>
		
	</div>
</template>


<script>
	export default {
		mounted() {
			
		},
		data() {
			return {
				value: [
					423,
					446,
					675,
					510,
					590,
					610,
					760
				]
			};
		},
		methods: {

		}
	};
</script>