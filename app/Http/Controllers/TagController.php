<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\tagsUser as TagsUser;
use App\tags as Tags;
use Illuminate\Http\Request;
use Auth;

class TagController extends Controller {


	public function getTagsUser(){

		$listTagsObj = TagsUser::where('user_id',Auth::user()->id)->get();
		$contenedorDeTagsName=array();
		$i=0;
		foreach ($listTagsObj as $tagObj) {

			$listTagsUser = Tags::where('id',$tagObj->tags_id)->get()->toJson();
			$contenedorDeTagsName[$i]= $listTagsUser;
			$i++;
		}
		return response()->api("yes","",$contenedorDeTagsName);

		
	}

	public function addNewTag(Request $request){
		$tagname= $request->input('tagname');
		$tag= new Tags;
		$tag->tagname=$tagname;
		$userTagObj=new TagsUser;
		$userTagObj->user_id=Auth::user()->id;
		$tag->save();
		$userTagObj->tags_id=$tag->id;
		$userTagObj->save();
		return response()->api("yes","Tag created successfully","");

	}

}
