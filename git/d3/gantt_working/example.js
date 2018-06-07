d3.json("sample_data.json", function(error, data1) {

    d3.json("config.json",function(error,config_json){
        var tasks = [];
        var json_length = Object.keys(data1).length;
        var machineIds = [];
        var unit = config_json.unit;
        for (var i = 1; i <= json_length; i++) {
            var box_color = data1[i].caster;
            var box_grade = data1[i].grade;
            var box_index = data1[i].id;

            for (var j = 0; j < data1[i].action_list.length; j++) {
                if (data1[i].action_list[j][0] == "operation") {
                    data1[i].action_list[j]["kindOfTask"] = data1[i].action_list[j][0];
                    data1[i].action_list[j]["machineId"] = data1[i].action_list[j][1];
                    data1[i].action_list[j]["slot"] = data1[i].action_list[j][2];
                    
                    var temp_time = new Date(config_json.baseTime);
                    if(unit=='min'){
                        var st_time = new Date(temp_time.setMinutes(temp_time.getMinutes() + data1[i].action_list[j][3]));
                        data1[i].action_list[j]["startDate"] = temp_time;
                        st_time.setMinutes(temp_time.getMinutes() + data1[i].action_list[j][4]);
                        data1[i].action_list[j]["endDate"] = st_time;   
                    }else{
                        var st_time = new Date(temp_time.setSeconds(temp_time.getSeconds() + data1[i].action_list[j][3]));
                        data1[i].action_list[j]["startDate"] = temp_time;
                        st_time.setSeconds(temp_time.getSeconds() + data1[i].action_list[j][4]);
                        data1[i].action_list[j]["endDate"] = st_time; 
                    }


                    data1[i].action_list[j]["caster"] = box_color;
                    data1[i].action_list[j]["grade"] = box_grade;
                    data1[i].action_list[j]["boxIndex"] = box_index;
                    data1[i].action_list[j]["duration"] = data1[i].action_list[j][4];

                    tasks.push(data1[i].action_list[j]);
                }
            }
        }

        machineIds = config_json.sequence;
        var taskStatus = {
            "BIC1": "task_style_1",
    		"SLC3":"task_style_2",
    		"BLC1":"task_style_3",
    		"BIC2":"task_style_4",
    		"SLC1":"task_style_5"
        };

        if(unit=='min'){
            var format = "%H:%M";    
        }else{
            var format = "%M:%S";    
        }
        
        var gantt = d3.gantt().taskTypes(machineIds).taskStatus(taskStatus).tickFormat(format);
        gantt(tasks);
    })
});