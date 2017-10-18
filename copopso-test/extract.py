import re

filename = "text.txt"
count = 0
dictOfIndex = {}

# open text file
with open(filename) as txtFile:
    txt = txtFile.read().split('\n')

# storing index of approppriate branch name to split
# up the data
for i in range(0, len(txt)):
    if txt[i] == "CIVIL ENGINEERING" :
        dictOfIndex['civil'] = i
    
    if txt[i] == "COMPUTER SCIENCE" :
        dictOfIndex['cs'] = i
   
    if txt[i] == "ELECTRONICS & COMMUNICATION ENGG" :
        dictOfIndex["ec"] = i
     
    if txt[i] == "ELECTRICAL AND ELECTRONICS ENGINEERING" :
        dictOfIndex["ee"] = i

    if txt[i] == "MECHANICAL ENGINEERING":
        dictOfIndex["mech"] = i
        
dictOfIndex["end"] = len(txt)       

def getGradesFromText(start, end="end"):
	grades = []
	result = {}
	extractedData = txt[dictOfIndex[start] : dictOfIndex[end]]

	for i in range(0, len(extractedData)):
		if re.search(r'.....\((..){1,}\)', extractedData[i]): 
			grades.append(extractedData[i])
	
	for val in grades[0].split(','):
		result[val.strip(" ").rstrip(")")[0:5]] = \
		   {"O": 0, "A+": 0, "A": 0, "B+":0, "B": 0, "C": 0, "P": 0, "F": 0, "FA": 0, "FS": 0}
		
		
	for grade in grades:
		for val in grade.split(','):
			if re.search(r'([OABCPFS+]+)\)$', val):
				g = re.search(r'([OABCPFS+]+)\)$', val).group().rstrip(")")
				result[val.strip(" ").rstrip(")")[0:5]][g] += 1
	
	
	return result    


# getting final results
civil = getGradesFromText('civil', 'cs')
cs = getGradesFromText('cs', 'ee')
ee = getGradesFromText('ee', 'ec')
ec = getGradesFromText('ec', 'mech')
mech = getGradesFromText('mech')

# just printing cs data only, can be done other branches also
for code in cs.keys():
	print "course code: " + code 
	for grade in cs[code].keys():
		print grade + " - " + str(cs[code][grade]) + "\t"



