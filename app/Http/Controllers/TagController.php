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

	public function delete(Request $request){
		//Esto ya casi funciona tete
		//el count da 0 todo el rato, algo pasa por ahi
        $tagName=$request->input('tagname');
        $idTag= Tags::where('tagname',$tagName)->get();
        $count= TagsUser::where('tags_id',$idTag[0]->id)->get()->count();
        //dd($count);

        if ($count ==0 ){

            return response()->api("no","This hashtag has not been assigned to you","");
        }else if( $count == 1){

            $tag= Tags::find($idTag[0]->id);
            $tag-> delete();
        }else;

        $tagUser= TagsUser::where('tags_id',$idTag[0]->id)->
                        where('user_id',Auth::user()->id);
        $tagUser-> delete();
        return response()->api("yes","Hashtag deleted succesfully","");
    }

}
