<template>
    <div>
        <div class="content">
			<div class="container-fluid">
					
				<!--~~~~~~~ TABLE ONE ~~~~~~~~~-->
				<div class="_1adminOverveiw_table_recent _box_shadow _border_radious _mar_b30 _p20">
					<p class="_title0">Tags <Button @click="addModal=true"><Icon type="md-add" />Add</Button></p>

					<div class="_overflow _table_div">
						<table class="_table">
								<!-- TABLE TITLE -->
							<tr>
								<th>Id</th>
								<th>Tag Name</th>
								<th>Created At</th>
								<th>Action</th>
							</tr>
								<!-- TABLE TITLE -->


								<!-- ITEMS -->
							<tr v-for="(tag, i) in tags" :key="i" v-if='tags.length'>
								<td>{{tag.id}}</td>
								<td class="_table_name">{{tag.tagName}}</td>
								<td>{{tag.created_at}}</td>
								<td>
									<Button type="info" size="small" @click="showEditModal(tag,i)">Edit</Button>
									<Button type="error" size="small" @click="showDeleteModal(tag,i)" :loading="tag.isDeleting">Delete</Button>
								</td>
							</tr>
						</table>
					</div>
				</div>
				<!-- add tag modal -->
				<Modal
					v-model="addModal"
					title="Add Tag"
					:mask-closable="false"
					:closable="false"
					>
					<Input v-model="data.tagName" placeholder="Enter Tagname" />

					<div slot="footer">
						<Button type="default" @click="addModal=false">Close</Button>
						<Button type="primary" @click="addTag" :disabled="isAdding" :loading="isAdding">{{ isAdding ? 'Adding...' : 'Add Tag'}}</Button>
					</div>
				</Modal>
				<!-- edit tag modal -->
				<Modal
					v-model="editModal"
					title="Edit Tag"
					:mask-closable="false"
					:closable="false"
					>
					<Input v-model="editData.tagName" placeholder="Enter Tagname" />

					<div slot="footer">
						<Button type="default" @click="editModal=false">Close</Button>
						<Button type="primary" @click="editTag" :disabled="isEditing" :loading="isEditing">{{ isEditing ? 'Editing...' : 'Update Tag'}}</Button>
					</div>
				</Modal>

				<!-- delete modal -->
				<Modal v-model="deleteModal" width="360">
					<p slot="header" style="color:#f60;text-align:center">
						<Icon type="ios-information-circle"></Icon>
						<span>Delete confirmation</span>
					</p>
					<div style="text-align:center">
						<p>Are you sure you want to delete?</p>
					</div>
					<div slot="footer">
						<Button type="error" size="large" long  @click="deleteTag">Delete</Button>
					</div>
				</Modal>
				

			</div>
		</div>
    </div>
</template>


<script>
export default{
	data(){
		return {
			data: {
				tagName: ''
			},
			addModal: false,
			editModal: false,
			isAdding: false,
			tags: [],
			editData: {
				tagName: '',
				id:''
			},
			isEditing:false,
			index: -1,
			deleteModal: false,
			deleteItem :{},
			i:-1

		}
	},

	async created(){
			const res = await this.callApi(
				'get','app/get_tags'
			)
			console.log(res)
			if(res.status ==200){
				this.tags = res.data
				
			}else{
				this.swr()
			}
		},

	methods : {
		
		async addTag(){
			if(this.data.tagName.trim()=='') return this.error('Tag name is required!')
			const res = await this.callApi('post','app/create_tag',this.data)
			if(res.status===201){
				this.tags.unshift(res.data)
				this.success('Tag has been added successfully!')
				this.addModal = false
			}else{
				if(res.status ===422){
					if(res.data.errors.tagName){
						this.info(res.data.errors.tagName[0])
					}
				}else{
					this.swr()
				}
				
			}
		},
		async editTag(){
			if(this.editData.tagName.trim()=='') return this.error('Tag name is required!')
			const res = await this.callApi('post','app/update_tag',this.editData)
			if(res.status===200){
				this.tags[this.index].tagName = this.editData.tagName
				this.success('Tag has been edited successfully!')
				this.editModal = false
			}else{
				if(res.status ===422){
					if(res.data.errors.tagName){
						this.info(res.data.errors.tagName[0])
					}
				}else{
					this.swr()
				}
				
			}
		},
		showEditModal(item,index){
			
			this.editData.tagName = item.tagName;
			this.editData.id = item.id;
			// console.log(item);
			this.editModal = true
			this.index = index
		},
		async deleteTag(){
			this.$set(this.deleteItem,'isDeleting',true)

			const res = await this.callApi('post','app/delete_tag',this.deleteItem)
			if(res.status ===200){
				this.tags.splice(this.i,1)
				this.success('Tags has been deleted successfully')
				this.deleteModal = false
			}else{
				this.swr()
			}
		},
		showDeleteModal(item,i){
			this.deleteItem = item
			this.i = i
			this.deleteModal = true
		}
		
	}
	
}
</script>
